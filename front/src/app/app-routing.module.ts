import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { TreinoDetalhesModule } from './pages/treino-detalhes/treino-detalhe.module';

const routes: Routes = [

  { path: 'alunos', loadChildren: () => import('./pages/alunos/alunos.module').then(m => m.AlunosModule) },
  { path: 'treinos', loadChildren: () => import('./pages/treinos/treinos.module').then(m => m.TreinosModule) },
  { path: 'exercicios', loadChildren: () => import('./pages/exercicios/exercicios.module').then(m => m.ExerciciosModule) },
  { path: 'treino-detalhe', loadChildren: () => import('./pages/treino-detalhes/treino-detalhe.module').then(m => m.TreinoDetalhesModule) },
  { path: ':id', component: TreinoDetalhesModule},
  { path: '', redirectTo: '/', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes, { relativeLinkResolution: 'legacy' })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
