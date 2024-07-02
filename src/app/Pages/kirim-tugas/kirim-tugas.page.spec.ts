import { ComponentFixture, TestBed } from '@angular/core/testing';
import { KirimTugasPage } from './kirim-tugas.page';

describe('KirimTugasPage', () => {
  let component: KirimTugasPage;
  let fixture: ComponentFixture<KirimTugasPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(KirimTugasPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
