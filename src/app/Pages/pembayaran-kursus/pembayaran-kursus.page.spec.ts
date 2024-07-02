import { ComponentFixture, TestBed } from '@angular/core/testing';
import { PembayaranKursusPage } from './pembayaran-kursus.page';

describe('PembayaranKursusPage', () => {
  let component: PembayaranKursusPage;
  let fixture: ComponentFixture<PembayaranKursusPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(PembayaranKursusPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
