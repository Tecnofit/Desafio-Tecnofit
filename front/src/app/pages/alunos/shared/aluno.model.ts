import { BaseResourceModel } from "../../../shared/models/base-resource.model";

export class Aluno extends BaseResourceModel {
  constructor(
    public id?:number,
    public nome?: string,
    public email?: string
  ){
    super();
  }

  static fromJson(jsonData: any): Aluno {
    return Object.assign(new Aluno(), jsonData);
  }
}