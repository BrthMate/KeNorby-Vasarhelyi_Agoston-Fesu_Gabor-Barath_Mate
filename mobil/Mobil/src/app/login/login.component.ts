import { NgModule } from '@angular/core';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from './auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
    
  loginForm !: FormGroup

  constructor(
    private auth: AuthService,
    private formBuilder: FormBuilder,
    private router: Router
    ) { }

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      user: [''],
      pass: ['']
    });
    if(localStorage.getItem('Id') && localStorage.getItem('UserName') && localStorage.getItem('Token')){
      this.router.navigate(['kenorby']);
    }
  }

  login() {
    let user = this.loginForm.value.user;
    let pass = this.loginForm.value.pass;
    let token = this.randomGenerator(32);
    this.auth.login(user, pass, token)
    .subscribe(res => {
      if (res.succes) {
        localStorage.setItem('UserName', 
        JSON.stringify({id: res.data.UserName})
        );
        localStorage.setItem('Id', 
        JSON.stringify({username: res.data.Id})
        );
        localStorage.setItem('Token', 
        JSON.stringify({Sid: token})
        );
        this.router.navigate(['kenorby']);
      }else{
        alert("A belépés sikertelen!");
      }
    })
  }

  randomGenerator(length :any){
    var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var token = "";
    for (var i = 0; i <= length; i++) {
      var randomNumber = Math.floor(Math.random() * chars.length);
      token += chars.substring(randomNumber, randomNumber +1);
    }
    return token;
  }
}


