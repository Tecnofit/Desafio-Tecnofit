import { BaseResourceModel } from "../../../shared/models/base-resource.model";

export class Treino extends BaseResourceModel {
  constructor(
    public id?:number,
    public descricao?: string
  ){
    super();
  }
  

  static fromJson(jsonData: any): Treino {
    return Object.assign(new Treino(), jsonData);
  }
}