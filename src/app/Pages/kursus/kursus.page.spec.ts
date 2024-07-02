import { ComponentFixture, TestBed } from '@angular/core/testing';
import { KursusPage } from './kursus.page';

describe('KursusPage', () => {
  let component: KursusPage;
  let fixture: ComponentFixture<KursusPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(KursusPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
