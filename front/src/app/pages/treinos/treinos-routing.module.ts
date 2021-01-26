import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { TreinoListComponent } from "./list/treino-list.component";
import { TreinoFormComponent } from "./form/treino-form.component";
//import { TreinoDetalheFormComponent } from "../treino-detalhes/form/treino-detalhe-form.component";


const routes: Routes = [
  { path: '', component: TreinoListComponent },
  { path: 'new', component: TreinoFormComponent },
  { path: ':id/edit', component: TreinoFormComponent },
  //{ path: ':id/edit', component: TreinoDetalheFormComponent }

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TreinosRoutingModule { }
