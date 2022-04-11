import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { AuthService } from './../login/auth.service';

@Component({
  selector: 'app-location',
  templateUrl: './location.component.html',
  styleUrls: ['./location.component.css']
})
export class LocationComponent implements OnInit{
  latitude :any;
  longitude :any; 
  time :any; 
  distance: any;
  start = false;
  constructor(private http: HttpClient,private router: Router,private auth: AuthService,) {}

  ngOnInit(): void {
    if(localStorage.getItem("start")==null){
      localStorage.setItem("start","start")
      this.start = true;
    }
    if(this.start){
      this.getLocation();
      this.startTime();
      setInterval(() => {
        this.getMove();
      }, 2000);
    }
  }
  getLocation(){
    navigator.geolocation.getCurrentPosition((pos) =>{
      this.latitude=pos.coords.latitude;
      this.longitude=pos.coords.longitude;
      this.distance = 0;
    });
  }
  startTime(){
     this.time = new Date().getTime();
  }
  getMove(){
    var options = {
      enableHighAccuracy: true,
      timeout: 1000,
      maximumAge: 0
    };
    navigator.geolocation.getCurrentPosition((pos) =>{
      let latitudeMove=pos.coords.latitude;
      let longitudeMove=pos.coords.longitude;

      let time = new Date().getTime();
      let timer = (Math.round((time-this.time)/1000))

      let hours = Math.floor(timer / 3600);
      let minutes =Math.floor((timer - hours * 3600 ) / 60)
      let seconds = timer - hours * 3600 - minutes * 60

      const distanceField = document.querySelector("#distance");
      const kmperhField = document.querySelector("#kmperh");
      const timerField = document.querySelector("#timer");
      
      this.distance += (Math.round(this.DistanceCalc(this.latitude,this.longitude,latitudeMove,longitudeMove))/1000);
      //console.log(this.DistanceCalc(this.latitude,this.longitude,latitudeMove,longitudeMove));
      
      this.latitude = latitudeMove;
      this.longitude = longitudeMove;
      
      let speed = Math.round(this.distance/(timer/3600));

      if (distanceField != null){
        distanceField.setAttribute('value',(Math.round(this.distance*1000)/1000).toString());
      }
      if (kmperhField != null){
        kmperhField.setAttribute('value',speed.toString());
      }
      if (timerField != null){
        timerField.setAttribute('value',hours.toString()+":"+minutes.toString()+":"+seconds.toString());
      }
    },this.error,options);
  }
  error() {
    console.log("hibatörtént");
  }
  DistanceCalc(lat1 :number,lon1 :number,lat2 :number,lon2 :number){
    //haversine formula
    const R = 6371e3; // metres
    const φ1 = lat1 * Math.PI/180; // φ, λ in radians
    const φ2 = lat2 * Math.PI/180;
    const Δφ = (lat2-lat1) * Math.PI/180;
    const Δλ = (lon2-lon1) * Math.PI/180;

    const a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
              Math.cos(φ1) * Math.cos(φ2) *
              Math.sin(Δλ/2) * Math.sin(Δλ/2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

    const d = R * c; // in metres
    return d;
  }
  logout(){
    this.auth.logout();
  }
  location(){
    this.router.navigate(['kenorby']);
  }
}
