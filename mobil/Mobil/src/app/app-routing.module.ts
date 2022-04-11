import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { MainComponent } from './main/main.component';
import { LoginComponent } from './login/login.component';
import { AuthGuard } from './login/auth.guard';
import {LocationComponent} from './location/location.component';

const routes: Routes = [
  {path:'speed', component: LocationComponent, canActivate: [AuthGuard]},
  {path:'kenorby', component: MainComponent, canActivate: [AuthGuard]},
  {path:'login', component: LoginComponent},
  {path:'', component: LoginComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
