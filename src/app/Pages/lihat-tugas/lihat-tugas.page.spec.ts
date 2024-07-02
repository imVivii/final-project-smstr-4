import { ComponentFixture, TestBed } from '@angular/core/testing';
import { LihatTugasPage } from './lihat-tugas.page';

describe('LihatTugasPage', () => {
  let component: LihatTugasPage;
  let fixture: ComponentFixture<LihatTugasPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(LihatTugasPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
