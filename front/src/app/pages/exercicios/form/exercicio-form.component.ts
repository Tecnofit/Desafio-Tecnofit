import { Component, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Exercicio } from "../shared/exercicio.model";
import { ExercicioService } from "../shared/exercicios.service";



@Component({
  selector: 'app-exercicio-form',
  templateUrl: './exercicio-form.component.html',
  styleUrls: ['./exercicio-form.component.css']
})
export class ExercicioFormComponent extends BaseResourceFormComponent<Exercicio> {
  exercicios: Array<Exercicio>;
  constructor(protected exercicioService: ExercicioService, protected injector: Injector) {
    super(injector, new Exercicio(), exercicioService, Exercicio.fromJson, "exercicio")
  }


  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      nome: [null, [Validators.required, Validators.minLength(2)]],
    });
  }


  protected creationPageTitle(): string {
    return "Cadastro do Novo Exercicio";
  }

  protected editionPageTitle(): string {
    const exercicioName = this.resource.nome || "";
    return "Editando Exercicio: " + exercicioName;
  }
}