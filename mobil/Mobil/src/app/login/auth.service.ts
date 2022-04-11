import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  host = 'http://localhost:8000/api/';
  constructor(private http: HttpClient,private router: Router) {}

  login(user: string, pass: string, token: string) {
   
    let authData = {
      UserName: user,
      UserPass: pass,
      Sid: token
    }
    let data = JSON.stringify(authData);

    let headerObj = new HttpHeaders({
      'Content-Type': 'application/json'
    });

    let header = {
      headers: headerObj
    }

    let endpoint = 'login';
    let url = this.host + endpoint;
    return this.http.post<any>(url, data, header);
  }
  isLoggedIn(){
    if(localStorage.getItem('Id') === null){
      return false;
    }
    if(localStorage.getItem('UserName') === null){
      return false;
    }
    if(localStorage.getItem('Token') === null){
      return false;
    }
    let Id:any = localStorage.getItem('Id');
    let Name:any = localStorage.getItem('UserName');
    let currentUserId = JSON.parse(Id);
    let currentUserName = JSON.parse(Name);
    let id = currentUserId.Id;
    let userName = currentUserName.Name;
    return true;
  }
  logout(){
    
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

    let endpoint = 'logout';
    let url = this.host + endpoint;
    
    this.http.post<any>(url, data, header);

    localStorage.removeItem("Id");
    localStorage.removeItem("start");
    localStorage.removeItem("Token")
    localStorage.removeItem("UserName");
    this.router.navigate(['']);
    
  }
}
