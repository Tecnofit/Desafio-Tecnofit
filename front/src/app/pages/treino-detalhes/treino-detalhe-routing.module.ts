import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { TreinoDetalheListComponent } from "./list/treino-detalhe-list.component";
import { TreinoDetalheFormComponent } from "./form/treino-detalhe-form.component";

const routes: Routes = [
  { path: '', component: TreinoDetalheListComponent },
  { path: ':id/new', component: TreinoDetalheFormComponent },
  { path: ':id/edit', component: TreinoDetalheFormComponent },
  { path: '/new/:id', component: TreinoDetalheFormComponent },
  { path: '/edit/:id', component: TreinoDetalheFormComponent }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TreinoDetalhesRoutingModule { }
