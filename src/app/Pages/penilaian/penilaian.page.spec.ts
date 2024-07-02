import { ComponentFixture, TestBed } from '@angular/core/testing';
import { PenilaianPage } from './penilaian.page';

describe('PenilaianPage', () => {
  let component: PenilaianPage;
  let fixture: ComponentFixture<PenilaianPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(PenilaianPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
