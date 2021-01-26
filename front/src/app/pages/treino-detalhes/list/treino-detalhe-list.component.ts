import { Component, Injector } from '@angular/core';
import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";
import { TreinoDetalhe } from "../shared/treino-detalhe.model";
import { TreinoDetalheService } from "../shared/treino-detalhe.service";


@Component({
  selector: 'app-treino-detalhe-list',
  templateUrl: './treino-detalhe-list.component.html',
  styleUrls: ['./treino-detalhe-list.component.css']
})


export class TreinoDetalheListComponent extends BaseResourceListComponent<TreinoDetalhe> {

  id: any;
  treinodetalhes: TreinoDetalhe

  constructor(private treinodetalheService: TreinoDetalheService, protected injector: Injector) {
    super(treinodetalheService, injector, "treino_detalhe");
  }

  ngOnInit() {
    super.ngOnInit();
  }

}

