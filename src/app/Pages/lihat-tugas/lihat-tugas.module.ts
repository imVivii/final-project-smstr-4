import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LihatTugasPageRoutingModule } from './lihat-tugas-routing.module';

import { LihatTugasPage } from './lihat-tugas.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LihatTugasPageRoutingModule
  ],
  declarations: [LihatTugasPage]
})
export class LihatTugasPageModule {}
