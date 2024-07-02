import { ComponentFixture, TestBed } from '@angular/core/testing';
import { LihatInformasiPage } from './lihat-informasi.page';

describe('LihatInformasiPage', () => {
  let component: LihatInformasiPage;
  let fixture: ComponentFixture<LihatInformasiPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(LihatInformasiPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
