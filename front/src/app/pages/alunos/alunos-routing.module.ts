import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AlunoListComponent } from "./list/aluno-list.component";
import { AlunoFormComponent } from "./form/aluno-form.component";

const routes: Routes = [
  { path: '', component: AlunoListComponent },
  { path: 'new', component: AlunoFormComponent },
    { path: ':id/edit', component: AlunoFormComponent }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AlunosRoutingModule { }
