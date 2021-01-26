import { Component, Injector } from '@angular/core';
import { Validators } from "@angular/forms";
import { MatDialog, MatDialogConfig } from '@angular/material/dialog';

import { BaseResourceFormComponent } from "../../../shared/components/base-resource-form/base-resource-form.component"

import { Treino } from "../shared/treino.model";
import { TreinoService } from "../shared/treino.service";

import { TreinoDetalheFormComponent } from "../../treino-detalhes/form/treino-detalhe-form.component";

import { TreinoDetalhe } from "../../treino-detalhes/shared/treino-detalhe.model";
import { TreinoDetalheService } from "../../treino-detalhes/shared/treino-detalhe.service";

import { Aluno } from "../../alunos/shared/aluno.model";
import { AlunoService } from "../../alunos/shared/aluno.service";

@Component({
  selector: 'app-treino-form',
  templateUrl: './treino-form.component.html',
  styleUrls: ['./treino-form.component.css']
})
export class TreinoFormComponent extends BaseResourceFormComponent<Treino> {

  alunos: Array<Aluno>;
  treinodetalhes: any;
  id: number;
  treino_id: number;
  erro: any = null;


  constructor(
    protected treinoService: TreinoService,
    protected alunoService: AlunoService,
    protected injector: Injector,
    protected treinoDetalheService: TreinoDetalheService,) {
    super(injector, new Treino(), treinoService, Treino.fromJson, "treino",)
  }
  ngOnInit() {
    this.route.params.subscribe(params => {
      this.id = params['id']
    });
    this.loadTreinoDetalhesById(this.id)
    this.loadAlunos();
    super.ngOnInit();
  }

  private loadAlunos() {
    this.alunoService.getAll().subscribe(
      alunos => this.alunos = alunos

    );
  }

  protected buildResourceForm() {
    this.resourceForm = this.formBuilder.group({
      id: [null],
      descricao: [null, [Validators.required, Validators.minLength(2)]],
      ativo: [true, [Validators.required]],
      aluno_id: [null, [Validators.required]]
    });
  }

  private loadTreino(id: number, caminho: string) {
    //this.treino = this.treinoService.getById(id, caminho)
    this.treinoService.getById(this.id, caminho).subscribe(treinodetail => {
      this.treinodetalhes = treinodetail
    });

  }
  public loadTreinoDetalhesById(id) {
    this.treinoDetalheService.readByTreino(id, "treino_detalhe").subscribe((data: TreinoDetalhe) => {
      if (data[0].code == 0) {
        this.treinodetalhes = null
        this.erro = data;
      }
      else {
        this.treinodetalhes = data

      }

    })

  }

  viewEditTreinoDetalhe(id: any, acao: string, treino_id?: number) {
    
    if (acao == 'new') {
      this.router.navigate(['treino-detalhe', id, 'new']);
    } else {
      this.router.navigate(['treino-detalhe', id, 'edit']);
    }
  }

  protected creationPageTitle(): string {
    return "Cadastro do Novo Treino";
  }

  protected editionPageTitle(): string {
    const treinoName = this.resource.descricao || "";
    return "Editando Treino: " + treinoName;
  }

}