import { BaseResourceModel } from "../../../shared/models/base-resource.model";

export class Exercicio extends BaseResourceModel {
  constructor(
    public id?:number,
    public nome?: string
  ){
    super();
  }
  

  static fromJson(jsonData: any): Exercicio {
    return Object.assign(new Exercicio(), jsonData);
  }
}