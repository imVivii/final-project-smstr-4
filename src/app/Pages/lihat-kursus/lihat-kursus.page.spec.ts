import { ComponentFixture, TestBed } from '@angular/core/testing';
import { LihatKursusPage } from './lihat-kursus.page';

describe('LihatKursusPage', () => {
  let component: LihatKursusPage;
  let fixture: ComponentFixture<LihatKursusPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(LihatKursusPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
