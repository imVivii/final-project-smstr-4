import { Component } from '@angular/core';

@Component({
  selector: 'app-kursus',
  templateUrl: 'kursus.page.html',
  styleUrls: ['kursus.page.scss'],
})
export class KursusPage {
  courses = [
    { id: 1, name: 'LARAVEL' },
    { id: 2, name: 'IONIC' },
    { id: 3, name: 'FIGMA' },
    { id: 4, name: 'CYBER' }
  ];
}
