import { Component, Injector } from '@angular/core';
import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";
import { Exercicio } from "../shared/exercicio.model";
import { ExercicioService } from "../shared/exercicios.service";


@Component({
  selector: 'app-exercicio-list',
  templateUrl: './exercicio-list.component.html',
  styleUrls: ['./exercicio-list.component.css']
})


export class ExercicioListComponent extends BaseResourceListComponent<Exercicio> {

  constructor(private exercicioService: ExercicioService,protected injector: Injector) {
    super(exercicioService,injector,"exercicio");
  }

}
