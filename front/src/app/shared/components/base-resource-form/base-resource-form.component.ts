import { OnInit, AfterContentChecked, Injector, Directive } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { ActivatedRoute, Router } from "@angular/router";

import { BaseResourceModel } from "../../models/base-resource.model"
import { BaseResourceService } from "../../services/base-resource.service"

import { switchMap } from "rxjs/operators";

import toastr from "toastr";
import { exit } from 'process';


@Directive()
export abstract class BaseResourceFormComponent<T extends BaseResourceModel> implements OnInit, AfterContentChecked {
  resources: T[] = [];
  currentAction: string;
  resourceForm: FormGroup;
  pageTitle: string;
  serverErrorMessages: string[] = null;
  submittingForm: boolean = false;
  baseComponentPath: string = null;
  id: number;
  acaodelete = false;
  // idParametro: number;

  protected route: ActivatedRoute;
  protected router: Router;
  protected formBuilder: FormBuilder;

  constructor(
    protected injector: Injector,
    public resource: T,
    protected resourceService: BaseResourceService<T>,
    protected jsonDataToResourceFn: (jsonData) => T,
    protected caminho: string
  ) {
    this.route = this.injector.get(ActivatedRoute);
    this.router = this.injector.get(Router);
    this.formBuilder = this.injector.get(FormBuilder);

  }

  ngOnInit() {
    this.setCurrentAction();
    this.buildResourceForm();
    this.loadResource();
  }

  ngAfterContentChecked() {
    this.setPageTitle();
  }

  submitForm() {
    if (this.acaodelete == true) {

      this.acaodelete = false;
      this.ngOnInit()
    } else {
      this.submittingForm = true;

      if (this.currentAction == "new") {
        this.createResource();
      }
      else { // currentAction == "edit"{
        this.updateResource();
      }
    }
  }


  // PRIVATE METHODS

  protected setCurrentAction() {


    let qtd_param = this.route.snapshot.url.length
    if (qtd_param == 2) {

      if (this.route.snapshot.url[1].path == "edit") {
        this.currentAction = "edit"
      } else {

        this.currentAction = "new"
      }
    } else {
      if (this.route.snapshot.url[0].path == "edit") {
        this.currentAction = "edit"
      }
      else {
        this.currentAction = "new"
      }
    }
  }

  protected loadResource() {
    if (this.currentAction == "edit") {

      this.route.paramMap.pipe(
        switchMap(params => this.resourceService.getById(+params.get("id"), this.caminho))
      )
        .subscribe(
          (resource) => {
            this.resource = resource;
            this.resourceForm.patchValue(resource) // binds loaded resource data to resourceForm
          },
          (error) => alert('Ocorreu um erro no servidor, tente mais tarde.')
        )
    }
  }


  protected setPageTitle() {
    if (this.currentAction == 'new')
      this.pageTitle = this.creationPageTitle();
    else {
      this.pageTitle = this.editionPageTitle();
    }
  }

  protected creationPageTitle(): string {
    return "Novo"
  }

  protected editionPageTitle(): string {
    return "Edição"
  }


  protected createResource() {
    const resource: T = this.jsonDataToResourceFn(this.resourceForm.value);

    this.resourceService.create(resource)
      .subscribe(
        resource => this.actionsForSuccess(resource),
        error => this.actionsForError(error)
      )
  }


  protected updateResource() {
    const resource: T = this.jsonDataToResourceFn(this.resourceForm.value);
    this.id = resource.treino_id
    this.resourceService.update(resource)
      .subscribe(
        resource => this.actionsForSuccess(resource, this.id),
        error => this.actionsForError(error)
      )
  }


  protected actionsForSuccess(resource: T, id?: number) {
    toastr.success("Solicitação processada com sucesso!");

    let urlantiga = this.route.snapshot.parent.url.toString()
    this.baseComponentPath = this.route.snapshot.parent.url[0].path;
    //if (this.route.snapshot.parent.url[0].path = "treino-detalhe") {
    if (urlantiga == "treino-detalhe") {
      this.baseComponentPath = "treinos/" + this.id + "/edit"
    }
    else {
      let qtd_param = this.route.snapshot.url.length
      if (qtd_param == 2) {

        if (urlantiga == "treinos") {
          this.baseComponentPath = "treinos/" + this.route.snapshot.url[0] + "/edit"
          this.ngOnInit()
        }
      }
    }

    //redirect/reload component page
    this.router.navigateByUrl(this.baseComponentPath, { skipLocationChange: false }).then(
      () => this.router.navigate([this.baseComponentPath])
    )
  }


  protected actionsForError(error) {
    toastr.error("Ocorreu um erro ao processar a sua solicitação!");
    this.submittingForm = false;

    if (error.status === 422)
      this.serverErrorMessages = JSON.parse(error._body).errors;
    else
      this.serverErrorMessages = ["Falha na comunicação com o servidor. Por favor, tente mais tarde."]
  }

  deleteResource(resource: T, otherresource?: string) {
    this.acaodelete = true;
    const mustDelete = confirm('Deseja realmente excluir este item?');
    if (mustDelete) {
      this.resourceService.delete(resource.id, otherresource).subscribe(
        () => this.resources = this.resources.filter(element => element != resource, this.actionsForSuccess(resource, this.id)),
        () => alert("Erro ao tentar excluir!")
      )
    }
  }


  protected abstract buildResourceForm(): void;
}
