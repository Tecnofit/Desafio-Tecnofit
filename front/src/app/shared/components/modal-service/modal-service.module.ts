import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ModalContainerComponent } from './components/modal-container/modal-container.components';
import { ModalService } from './modal-service.services';

@NgModule({
  imports: [
    CommonModule
  ],
  declarations: [
    ModalContainerComponent
  ],
  entryComponents: [
    ModalContainerComponent
  ]
})
export class ModalServiceModule {
  static forRoot() {
    return {
      ngModule: ModalServiceModule,
      providers: [
        ModalService
      ]
    }
  }
}