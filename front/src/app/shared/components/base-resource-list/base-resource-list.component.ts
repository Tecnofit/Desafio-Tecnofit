import { OnInit, Directive, Injector } from '@angular/core';

import { BaseResourceModel } from "../../models/base-resource.model";
import { BaseResourceService } from "../../services/base-resource.service";
import { ActivatedRoute, Router } from "@angular/router";
//import {TreinoDetalheListComponent } from "../../treino-detalhes/list/treino-detalhe-list.component"
import toastr from "toastr";
import { disposeEmitNodes } from 'typescript';
import { exit } from 'process';


@Directive()
export abstract class BaseResourceListComponent<T extends BaseResourceModel> implements OnInit {

  resources: T[] = [];
  protected route: ActivatedRoute;
  protected router: Router;


  constructor(
    private resourceService: BaseResourceService<T>,
    protected injector: Injector,
     protected action: string,) {
    this.route = this.injector.get(ActivatedRoute);
    this.router = this.injector.get(Router);
  }

  ngOnInit() {
    this.resourceService.getAll().subscribe(
      resources => this.resources = resources.sort((a,b) => b.id - a.id),
      error => alert('Erro ao carregar a lista ')
    )
  }

  deleteResource(resource: T, otherresource?: string ) {
    const mustDelete = confirm('Deseja realmente excluir este item?');
    if (mustDelete){
      this.resourceService.delete(resource.id, otherresource).subscribe(
        () => this.resources = this.resources.filter(element => element != resource),
        () => alert("Erro ao tentar excluir!")
      )
    }
  }
}