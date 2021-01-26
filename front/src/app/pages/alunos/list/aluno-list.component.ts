import { Component, Injector } from '@angular/core';
import { BaseResourceListComponent } from "../../../shared/components/base-resource-list/base-resource-list.component";
import { Aluno } from "../shared/aluno.model";
import { AlunoService } from "../shared/aluno.service";


@Component({
  selector: 'app-aluno-list',
  templateUrl: './aluno-list.component.html',
  styleUrls: ['./aluno-list.component.css']
})


export class AlunoListComponent extends BaseResourceListComponent<Aluno> {

  constructor(private alunoService: AlunoService,protected injector: Injector) {
    super(alunoService,injector,"aluno");
  }

}
