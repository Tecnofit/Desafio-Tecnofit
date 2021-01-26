import { Component, Injector, Inject } from '@angular/core';
import { Validators } from "@angular/forms";
import { switchMap } from "rxjs/operators";

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { TreinoDetalhe } from "../shared/treino-detalhe.model";
import { TreinoDetalheService } from "../shared/treino-detalhe.service";

import { Treino } from "../../treinos/shared/treino.model";
import { TreinoService } from "../../treinos/shared/treino.service";
import { Exercicio } from "../../exercicios/shared/exercicio.model";
import { ExercicioService } from "../../exercicios/shared/exercicios.service";

import { Aluno } from '../../alunos/shared/aluno.model';


@Component({
  selector: 'app-treino-detalhe-form',
  templateUrl: './treino-detalhe-form.component.html',
  styleUrls: ['./treino-detalhe-form.component.css']
})
export class TreinoDetalheFormComponent extends BaseResourceFormComponent<TreinoDetalhe> {
  treinos: any;
  exercicios: Array<Exercicio>;
  id: number;
  treino_id: number;
  constructor(
    protected treinodetalheService: TreinoDetalheService,
    protected treinoService: TreinoService,
    protected injector: Injector,
    protected exercicioService: ExercicioService,

  ) {
    super(injector, new TreinoDetalhe(), treinodetalheService, TreinoDetalhe.fromJson, "treino_detalhe")
  }
  ngOnInit() {
    this.route.params.subscribe(params => {
      this.id = params['id']
    });


    this.loadAluno()
    this.loadExercicios()
    super.ngOnInit();
  }

  protected loadAluno() {

    this.route.paramMap.pipe(
      switchMap(params => this.resourceService.getById(+params.get("id"), this.caminho))
    )
      .subscribe(
        (resource) => {
          let qtd_param = this.route.snapshot.url.length
          if (qtd_param == 2) {
            if (this.route.snapshot.url[1].path == "edit") {
              this.treino_id = resource['treino_id']
            }

            else {
              this.treino_id = this.id
            }
          }
          this.resourceForm.patchValue(resource) // binds loaded resource data to resourceForm
          this.treinoService.getById(this.treino_id, "treino").subscribe(treino => {
            this.treinos = treino
            this.treino_id = treino.id
            this.resourceForm.patchValue({ 'treino_id': treino.id })
            this.resourceForm.patchValue({ 'aluno_nome': treino.aluno.nome })
          });

        },
        (error) => alert('Ocorreu um erro no servidor, tente mais tarde.')
      )

  }

  private loadExercicios() {
    this.exercicioService.getAll().subscribe(exercicios =>
      this.exercicios = exercicios
    );
  }

  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      treino_id: [null, [Validators.required, Validators.minLength(1)]],
      series: [null, [Validators.required, Validators.min(1)]],
      exercicio_id: [null],
      repeticoes: [null, [Validators.required, Validators.min(1)]],
      aluno_id: [null],
      aluno_nome: [null],
      status: [null]
    });
  }

  protected creationPageTitle(): string {
    return "Cadastro do Novo Detalhe do Treino";
  }

  protected editionPageTitle(): string {
    const treinodetalheName = this.resource.treino_id || "";
    return "Editando TreinoDetalhe: " + treinodetalheName;
  }
}