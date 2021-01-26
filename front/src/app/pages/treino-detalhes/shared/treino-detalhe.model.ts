import { BaseResourceModel } from "../../../shared/models/base-resource.model";
import { Exercicio } from "../../../pages/exercicios/shared/exercicio.model";
import { Treino } from "../../../pages/treinos/shared/treino.model";
import { Aluno } from "../../alunos/shared/aluno.model";


export class TreinoDetalhe extends BaseResourceModel {
  constructor(
    public id?:number,
    public treino_id?: number,
    //public aluno? :  Aluno,
    public treino?: Treino,
    public exercicio_id?: number,
    public exercicio?: Exercicio,
    public series?: number,
    public repeticoes?: number,
    public status?:number
  ){
    super();
  }
  get statusText(): string {
    if (this.status == 0)
      return 'Não concluído'
    else
    if (this.status == 1)
      return 'Concluído'
      else
      return 'Pulou'
  }

  get tagColor(): string {
    if (this.status == 0)
      return 'badge-pill bg-secondary'
    else
    if (this.status == 1)
      return 'badge-pill badge-success'
      else 
      return 'badge-pill badge-warning'
  }
  static fromJson(jsonData: any): TreinoDetalhe {
    return Object.assign(new TreinoDetalhe(), jsonData);
  }
}