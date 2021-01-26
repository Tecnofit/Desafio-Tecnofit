import { Injectable, Injector } from '@angular/core';
import { Exercicio } from "./exercicio.model";


import { BaseResourceService } from "../../../shared/services/base-resource.service";

@Injectable({
  providedIn: 'root'
})
export class ExercicioService extends BaseResourceService<Exercicio> {

  constructor(protected injector: Injector) {
    super("exercicio", injector, Exercicio.fromJson);
  }

}