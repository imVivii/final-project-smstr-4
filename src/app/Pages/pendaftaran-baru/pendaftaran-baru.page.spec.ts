import { ComponentFixture, TestBed } from '@angular/core/testing';
import { PendaftaranBaruPage } from './pendaftaran-baru.page';

describe('PendaftaranBaruPage', () => {
  let component: PendaftaranBaruPage;
  let fixture: ComponentFixture<PendaftaranBaruPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(PendaftaranBaruPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
