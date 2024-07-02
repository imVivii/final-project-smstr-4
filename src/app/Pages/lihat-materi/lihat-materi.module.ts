import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LihatMateriPageRoutingModule } from './lihat-materi-routing.module';

import { LihatMateriPage } from './lihat-materi.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LihatMateriPageRoutingModule
  ],
  declarations: [LihatMateriPage]
})
export class LihatMateriPageModule {}
