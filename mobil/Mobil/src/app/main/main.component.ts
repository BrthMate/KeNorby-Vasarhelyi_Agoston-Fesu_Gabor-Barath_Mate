import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { AuthService } from './../login/auth.service';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})
export class MainComponent implements OnInit {

  CalcForm !: FormGroup;

  constructor(private formBuilder: FormBuilder,private http: HttpClient,private router: Router,private auth: AuthService,
    ){
    this.CalcForm = this.formBuilder.group({
      input: '0' ?? [{
        value: '',
      }]
    });
  }
  host = 'http://localhost:8000/api/';
  update(number: number,index:number) {

    let Storage:any = localStorage.getItem('Token');
    let token = JSON.parse(Storage);
    let SidToken = token.Sid;

    let Data = {
      Counter: number,
      UserId: index,
      Sid:SidToken
    }
    let data = JSON.stringify(Data);

    let headerObj = new HttpHeaders({
      'Content-Type': 'application/json'
    });

    let header = {
      headers: headerObj
    }

    let endpoint = 'kenorby';
    let url = this.host + endpoint;
    return this.http.post<any>(url, data, header);
  }
  select(index:number) {
    
    let Storage:any = localStorage.getItem('Token');
    let token = JSON.parse(Storage);
    let SidToken = token.Sid;

    let Data = {
      UserId: index,
      Sid:SidToken
    }
    let data = JSON.stringify(Data);

    let headerObj = new HttpHeaders({
      'Content-Type': 'application/json'
    });

    let header = {
      headers: headerObj
    }

    let endpoint = 'counter';
    let url = this.host + endpoint;
    return this.http.post<any>(url, data, header);
  }
  SelectCounter() {

    let Storage:any = localStorage.getItem('Token');
    let token = JSON.parse(Storage);
    let SidToken = token.Sid;
   
    let Data = {
      "Sid":SidToken
    }
    let data = JSON.stringify(Data);

    let headerObj = new HttpHeaders({
      'Content-Type': 'application/json'
    });

    let header = {
      headers: headerObj
    }

    let endpoint = 'sum';
    let url = this.host + endpoint;
    return this.http.post<any>(url, data, header);
  }
  onClickSzamitoMinusz(){
    let szam = Number(this.CalcForm.value.input);
    let clac = szam-1;
    this.CalcForm.patchValue({input: clac});
  }
  onClickSzamitoPlus(){
    let szam = Number(this.CalcForm.value.input);
    let clac = szam+1;
    this.CalcForm.patchValue({input: clac});
  }
  ngOnInit(): void {
    if(!localStorage.getItem('Id') && !localStorage.getItem('UserName')){
      this.router.navigate(['']);
    }else{
    this.CalcForm = this.formBuilder.group({
      UserId: localStorage.getItem('Id'),
      input: this.SelectData() ?? [{
        value: '',
      }],
    });
    this.SelectData();
    this.SelectBigCounter();
  }
  }
  sendData(){
    let input = this.CalcForm.value.input;
    let id = this.CalcForm.value.UserId;
    this.update(input,parseInt(id.replace("}","").substring(id.indexOf(':')+1)))
    .subscribe(res => {
      if (res.succes) {
        //console.log("siker")
        this.SelectBigCounter();
      }else{
        alert("Sikertelen!");
      }
    })
  }
  SelectData(){
    let result=0;
    let id = localStorage.getItem('Id') ?? "";
    this.select(parseInt(id.replace("}","").substring(id.indexOf(':')+1)))
    .subscribe(res => {
      const Counter = document.getElementById("Counter") ;
      if (res.succes) {
        if(Counter !=null){
          Counter.setAttribute("value", res.data.Counter);
        }
        result=this.CalcForm.value.input=res.data.Counter;
      }else{
        alert("Sikertelen!");
        result=0;
      }
    })
    return result;
  }
  SelectBigCounter(){
    let result=0;
    const BigCounter = document.getElementById("counterAll") ;
    this.SelectCounter()
    .subscribe(res => {
      if (res.succes) {
        if(BigCounter !=null){
          BigCounter.setAttribute("value", res.data.Counter);
        }
      }else{
        alert("Sikertelen!");
        result=0;
      }
    })
    return result;
  }
  logout(){
    this.auth.logout();
  }
  location(){
    this.router.navigate(['speed']);
  }
  
}
