import { ComponentFixture, TestBed } from '@angular/core/testing';
import { PendaftaranPage } from './pendaftaran.page';

describe('PendaftaranPage', () => {
  let component: PendaftaranPage;
  let fixture: ComponentFixture<PendaftaranPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(PendaftaranPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
