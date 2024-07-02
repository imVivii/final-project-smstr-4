import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LihatInformasiPageRoutingModule } from './lihat-informasi-routing.module';

import { LihatInformasiPage } from './lihat-informasi.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LihatInformasiPageRoutingModule
  ],
  declarations: [LihatInformasiPage]
})
export class LihatInformasiPageModule {}
