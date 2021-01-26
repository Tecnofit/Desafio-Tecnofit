import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { ExerciciosRoutingModule } from './exercicios-routing.module';
import { ExercicioFormComponent } from './form/exercicio-form.component';
import { ExercicioListComponent } from "./list/exercicio-list.component";

@NgModule({
  imports: [
    SharedModule,
    ExerciciosRoutingModule
  ],
  declarations: [ExercicioListComponent, ExercicioFormComponent]
})
export class ExerciciosModule { }