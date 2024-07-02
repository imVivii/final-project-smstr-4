import { ComponentFixture, TestBed } from '@angular/core/testing';
import { IsiKehadiranPage } from './isi-kehadiran.page';

describe('IsiKehadiranPage', () => {
  let component: IsiKehadiranPage;
  let fixture: ComponentFixture<IsiKehadiranPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(IsiKehadiranPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
