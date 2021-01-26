import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ExercicioListComponent } from "./list/exercicio-list.component";
import { ExercicioFormComponent } from "./form/exercicio-form.component";

const routes: Routes = [
  { path: '', component: ExercicioListComponent },
  { path: 'new', component: ExercicioFormComponent },
  //{ path: ':id/edit', component: ExercicioFormComponent }
  { path: ':id/edit', component: ExercicioFormComponent }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ExerciciosRoutingModule { }
