import { BaseResourceModel } from "../models/base-resource.model";

import { Injector } from "@angular/core";
import { HttpClient } from "@angular/common/http";

import { Observable, throwError } from "rxjs";
import { map, catchError, elementAt } from "rxjs/operators";
//import { Console } from "console";


export abstract class BaseResourceService<T extends BaseResourceModel> {

  protected http: HttpClient;
  protected apiBackEnd: string;
  protected caminho: string;

  constructor(
    protected apiPath: string,
    protected injector: Injector,
    protected jsonDataToResourceFn: (jsonData: any) => T,
  ) {
    this.apiBackEnd = "http://localhost:8001/api/"
    this.http = injector.get(HttpClient);

  }

  getAll(): Observable<T[]> {
    return this.http.get(`${this.apiBackEnd + this.apiPath}/read.php`).pipe(
      map(this.jsonDataToResources.bind(this)),
      catchError(this.handleError)
    )
  }

  getById(id: number, caminho: string): Observable<T> {
    //const url = `${this.apiBackEnd + this.apiPath}/read_single.php?id=${id}`
    const url = `${this.apiBackEnd + caminho}/read_single.php?id=${id}`
    return this.http.get(url).pipe(
      map(this.jsonDataToResource.bind(this)),
      catchError(this.handleError)
    )
  }

  readByTreino(id: number, caminho: string): Observable<T> {
    const url = `${this.apiBackEnd + this.apiPath}/readByTreino.php?treino_id=${id}`
    return this.http.get(url).pipe(
      // map(this.jsonDataToResource.bind(this)),
      map(this.jsonDataToResources.bind(this)),
      catchError(this.errorsemDetalhes)
    )
  }


  create(resource: T): Observable<T> {
    const url = `${this.apiBackEnd + this.apiPath}/create.php`
    return this.http.post(url, resource).pipe(
      map(this.jsonDataToResource.bind(this)),
      catchError(this.handleError)
    )
  }

  update(resource: T): Observable<T> {
    const url = `${this.apiBackEnd + this.apiPath}/update.php`

    return this.http.put(url, resource).pipe(
      map(() => resource),
      catchError(this.handleError)
    )
  }

  delete(id: number, otherresource?: string): Observable<any> {
    //const url = `${this.apiPath}/${id}`;
    if (otherresource != null) {
      this.apiPath = otherresource;
    }
    const url = `${this.apiBackEnd + this.apiPath}/delete.php?id=${id}`
      return this.http.delete(url).pipe(
        map(() => null),
        catchError(this.handleError)
    )
  }

  protected jsonDataToResources(jsonData: any[]): T[] {
    const resources: T[] = [];
    jsonData.forEach(
      element => resources.push(this.jsonDataToResourceFn(element)),
    );
    return resources;
  }

  protected jsonDataToResource(jsonData: any): T {
    return this.jsonDataToResourceFn(jsonData);
  }

  protected handleError(error: any): Observable<any> {
    // alert("erro")
    console.log("ERRO NA REQUISIÇÃO => ", error);
    return throwError(error);
  }


  protected errorsemDetalhes(error: any): Observable<any> {
    alert('Não existem exercícios cadastrados para esse treino')
    return throwError(error);
  }

}