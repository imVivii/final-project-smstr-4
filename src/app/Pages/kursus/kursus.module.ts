import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { KursusPageRoutingModule } from './kursus-routing.module';

import { KursusPage } from './kursus.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    KursusPageRoutingModule
  ],
  declarations: [KursusPage]
})
export class KursusPageModule {}
