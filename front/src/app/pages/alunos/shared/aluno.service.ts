import { Injectable, Injector } from '@angular/core';
import { Aluno } from "./aluno.model";


import { BaseResourceService } from "../../../shared/services/base-resource.service";

@Injectable({
  providedIn: 'root'
})
export class AlunoService extends BaseResourceService<Aluno> {

  constructor(protected injector: Injector) {
    super("aluno", injector, Aluno.fromJson);
  }

}