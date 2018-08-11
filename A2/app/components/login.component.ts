// Importar el núcleo de Angular
import {Component, OnInit} from '@angular/core';
// Decorador component, indicamos en que etiqueta se va a cargar la
@Component({
    selector: 'login',
    templateUrl: 'app/view/login.html'
})
// Clase del componente donde irán los datos y funcionalidades
export class LoginComponent  implements OnInit {
  public titulo: string ="Identificate"
  public user;

  ngOnInit(){
      this.user = {
        "email": "",
        "password": "",
        "gethash": "false"
      };
  }

  onSubmit(){
    console.log(this.user);
    
  }

}
