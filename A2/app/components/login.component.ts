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
  public identity;
  public token;
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
// AL cargar apareceran estos datos de usuario
      console.log("******* U S E R  I D   &   T O K E N **************");
       let ide = this._loginService.getIdentity();
       let tk  = this._loginService.getToken();
      console.log(ide);
      console.log(tk);
      console.log ("******************************************************");
  }

  onSubmit(){
    console.log(this.user);
    this._loginService.signup(this.user).subscribe(
      response => {
        console.log (response);
        //guardar token en local storage
        let identity=response;
        this.identity=identity;

        if(this.identity.length <=0){
          alert("error en el servidor U");
        }else {
          if (!this.identity.status){
            localStorage.setItem('identity',JSON.stringify(identity));
          //  console.log(localStorage.getItem('identity'));
            this.user.gethash="true";
                    this._loginService.signup(this.user).subscribe(  response => {
                    console.log (response);
                        //guardar token en local storage
                        let token=response;
                        this.token=token;
                        if(this.token.length <=0){
                          alert("error en el servidor Token");
                        }else {
                          if (!this.token.status){
                            localStorage.setItem('token',JSON.stringify(token));
                            console.log("******* U S E R  I D   &   T O K E N **************");
                            let ide = localStorage.getItem('identity');
                            let tk  = localStorage.getItem('token');
                            console.log(ide);
                            console.log(tk);
                            console.log ("******************************************************");
                            //REDIRECTION
                          }
                        }
                      },
                      error    => {
                        this.errorMessage = <any>error;
                        if(this.errorMessage != null){
                          console.log (this.errorMessage);
                            console.log("Error en la petición Token");
                        }
                      })
                  }
                }
              },
      error    => {
        this.errorMessage = <any>error;
        if(this.errorMessage != null){
          console.log (this.errorMessage);
            console.log("Error en la petición identity");
        }
      }
    );

  }

}
