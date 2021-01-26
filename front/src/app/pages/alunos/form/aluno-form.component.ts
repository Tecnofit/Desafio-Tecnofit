import { Component, Injector } from '@angular/core';
import { Validators } from "@angular/forms";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Aluno } from "../shared/aluno.model";
import { AlunoService } from "../shared/aluno.service";

import { Treino } from "../../treinos/shared/treino.model";
import { TreinoService } from "../../treinos/shared/treino.service";


@Component({
  selector: 'app-aluno-form',
  templateUrl: './aluno-form.component.html',
  styleUrls: ['./aluno-form.component.css']
})
export class AlunoFormComponent extends BaseResourceFormComponent<Aluno> {
  treinos: Array<Treino>;

  constructor(protected alunoService: AlunoService,protected treinoService: TreinoService, protected injector: Injector) {
    super(injector, new Aluno(), alunoService, Aluno.fromJson, "aluno")
  }
  
  ngOnInit() {
    super.ngOnInit();
  }

  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      nome: [null, [Validators.required, Validators.minLength(2)]],
      email: [null],
      //treino_id:[null]
    });
  }
  private loadTreinos(){
    this.treinoService.getAll().subscribe(
      treinos => this.treinos = treinos
    );
  }

  protected creationPageTitle(): string {
    return "Cadastro do Novo Aluno";
  }

  protected editionPageTitle(): string {
    const alunoName = this.resource.nome || "";
    return "Editando Aluno: " + alunoName;
  }
}