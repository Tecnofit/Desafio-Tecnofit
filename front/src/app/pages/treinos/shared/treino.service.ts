import { Injectable, Injector } from '@angular/core';
import { Treino } from "./treino.model";
import { AlunoService } from "../../alunos/shared/aluno.service";
import { TreinoDetalheService } from "../../treino-detalhes/shared/treino-detalhe.service";

import { BaseResourceService } from "../../../shared/services/base-resource.service";

@Injectable({
  providedIn: 'root'
})
export class TreinoService extends BaseResourceService<Treino> {

  constructor(protected injector: Injector, private alunoService: AlunoService, private tds: TreinoDetalheService) {
    super("treino", injector, Treino.fromJson);
  }

}