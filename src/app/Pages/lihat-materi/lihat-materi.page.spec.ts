import { ComponentFixture, TestBed } from '@angular/core/testing';
import { LihatMateriPage } from './lihat-materi.page';

describe('LihatMateriPage', () => {
  let component: LihatMateriPage;
  let fixture: ComponentFixture<LihatMateriPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(LihatMateriPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
