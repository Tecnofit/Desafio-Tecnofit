import { Injectable, Injector } from '@angular/core';
import { TreinoDetalhe } from "./treino-detalhe.model";


import { BaseResourceService } from "../../../shared/services/base-resource.service";

@Injectable({
  providedIn: 'root'
})
export class TreinoDetalheService extends BaseResourceService<TreinoDetalhe> {

  constructor(protected injector: Injector) {
    super("treino_detalhe", injector, TreinoDetalhe.fromJson);
  }

}