import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';

import { TreinoDetalheListComponent } from './treino-detalhe-list.component';

describe('TreinoDetalheComponent', () => {
  let component: TreinoDetalheListComponent;
  let fixture: ComponentFixture<TreinoDetalheListComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [ TreinoDetalheListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TreinoDetalheListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
