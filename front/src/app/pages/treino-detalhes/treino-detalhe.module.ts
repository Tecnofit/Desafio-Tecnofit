import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { TreinoDetalhesRoutingModule } from './treino-detalhe-routing.module';
import { TreinoDetalheFormComponent } from './form/treino-detalhe-form.component';
import { TreinoDetalheListComponent } from "./list/treino-detalhe-list.component";

@NgModule({
  imports: [
    SharedModule,
    TreinoDetalhesRoutingModule
  ],
  declarations: [TreinoDetalheListComponent, TreinoDetalheFormComponent]
})
export class TreinoDetalhesModule { }