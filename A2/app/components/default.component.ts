// Importar el núcleo de Angular
import {Component} from '@angular/core';
import {ROUTER_DIRECTIVES, Router, ActivatedRoute} from "@angular/router";
import {LoginService} from '../services/login.service';
// Decorador component, indicamos en que etiqueta se va a cargar la
@Component({
    selector: 'default',
    templateUrl: 'app/view/default.html',
    directives: [ROUTER_DIRECTIVES],
    providers: [LoginService]
})

// Clase del componente donde irán los datos y funcionalidades
export class DefaultComponent {
public identity;
  public token;
public titulo = "Portada";
constructor(private _loginService: LoginService){}

ngOnInit(){
    this.identity = this._loginService.getIdentity();
    this.token= this._loginService.getToken();
}


}
