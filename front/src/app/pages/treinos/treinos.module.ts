import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { TreinosRoutingModule } from './treinos-routing.module';
import { TreinoFormComponent } from './form/treino-form.component';
import { TreinoListComponent } from "./list/treino-list.component";
// import { TreinoDetalheListComponent } from "../treino-detalhes/list/treino-detalhe-list.component";

@NgModule({
  imports: [
    SharedModule,
    TreinosRoutingModule
  ],
  declarations: [TreinoListComponent, TreinoFormComponent]
})
export class TreinosModule { }