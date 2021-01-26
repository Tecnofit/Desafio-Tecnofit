import { BaseResourceModel } from "../../../shared/models/base-resource.model";
import { Aluno } from "../../alunos/shared/aluno.model";

export class Treino extends BaseResourceModel {
  constructor(
    public id?: number,
    public aluno_id?: number,
    public aluno?: Aluno,
    public descricao?: string,
    public ativo?: number
  ) {
    super();
  }
  
  static fromJson(jsonData: any): Treino {
    return Object.assign(new Treino(), jsonData);
  }

  get ativoText(): string {
    if (this.ativo == 1)
      return 'Ativo'
    else
      return 'Desativado'
  }
  get tagColor(): string {
    if (this.ativo == 1)
      return 'badge-pill bg-primary'
    else
      return 'badge-pill bg-light'
  }
}