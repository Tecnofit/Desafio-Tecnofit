import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';

import { TreinoDetalheComponent } from './treinodetalhe-form.component';

describe('TreinoDetalheComponent', () => {
  let component: TreinoDetalheComponent;
  let fixture: ComponentFixture<TreinoDetalheComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [ TreinoDetalheComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TreinoDetalheComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
