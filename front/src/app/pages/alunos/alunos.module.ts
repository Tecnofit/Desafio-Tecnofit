import { NgModule } from '@angular/core';
import { SharedModule } from "../../shared/shared.module";

import { AlunosRoutingModule } from './alunos-routing.module';
import { AlunoFormComponent } from './form/aluno-form.component';
import { AlunoListComponent } from "./list/aluno-list.component";

@NgModule({
  imports: [
    SharedModule,
    AlunosRoutingModule
  ],
  declarations: [AlunoListComponent, AlunoFormComponent]
})
export class AlunosModule { }