import { Component, Injector, Input } from '@angular/core';
import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";

import { Treino } from "../shared/treino.model";
import { TreinoService } from "../shared/treino.service";

import { Aluno } from "../../alunos/shared/aluno.model";
import { AlunoService } from "../../alunos/shared/aluno.service";

import { TreinoDetalhe } from "../../treino-detalhes/shared/treino-detalhe.model";
import { TreinoDetalheService } from "../../treino-detalhes/shared/treino-detalhe.service";

// import { TreinoDetalheListComponent } from "../../treino-detalhes/list/treino-detalhe-list.component"
// import { exit } from 'process';
// import { nullSafeIsEquivalent } from '@angular/compiler/src/output/output_ast';


@Component({
  selector: 'app-treino-list',
  templateUrl: './treino-list.component.html',
  styleUrls: ['./treino-list.component.css']
})


export class TreinoListComponent extends BaseResourceListComponent<Treino> {
  alunos: Array<Aluno>;
  treinodetalhes: any;
  erro: any = null;
  visibleRrowIndex: number = null;
  state: boolean = true;

  constructor(
    private treinoService: TreinoService,
    protected alunoService: AlunoService,
    protected treinoDetalheService: TreinoDetalheService,
    protected injector: Injector,
  ) {
    super(treinoService, injector, "treino");
  }
  ngOnInit() {
    super.ngOnInit();
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
  viewEditTreinoDetalhe(id: any) {
    this.router.navigate(['treino-detalhe', id, 'edit']);
  }


}
