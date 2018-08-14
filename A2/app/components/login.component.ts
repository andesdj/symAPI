// Importar el núcleo de Angular
import {Component, OnInit} from '@angular/core';
import {LoginService} from '../services/login.service';

// Decorador component, indicamos en que etiqueta se va a cargar la
@Component({
    selector: 'login',
    templateUrl: 'app/view/login.html',
    providers: [LoginService]
})
// Clase del componente donde irán los datos y funcionalidades
export class LoginComponent  implements OnInit {
  public titulo: string ="Identificate"
  public user;
  public errorMessage;

  constructor(
        private _loginService: LoginService
  ){

  }

  ngOnInit(){
//    alert (this._loginService.signup())
      this.user = {
        "email": "",
        "password": "",
        "gethash": "false"
      };
  }

  onSubmit(){
    console.log(this.user);
    this._loginService.signup(this.user).subscribe(
      response => {
        alert(response);
      },
      error    => {
        this.errorMessage = <any>error;
        if(this.errorMessage != null){
          console.log (this.errorMessage);
          alert("Error en la petición");
        }
      }
    );

  }

}
