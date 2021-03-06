import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CourseDetailComponent } from './course-detail/course-detail.component';
import { CourseListComponent } from './course-list/course-list.component';
import { HistoryComponent } from './history/history.component';
import { LandingComponent } from './landing/landing.component';
import { LoginComponent } from './login/login.component';
import { ManageCourseComponent } from './course-detail/manage-course/manage-course.component';
import { PlayComponent } from './play/play.component';
import { ProfileComponent } from './profile/profile.component';
import { SignupComponent } from './signup/signup.component';
import { TrackComponent } from './course-detail/track/track.component';
import { GameComponent } from './game/game.component';
import { AuthGuard } from './auth.guard';
import { CourseOverviewComponent } from './course-detail/course-overview/course-overview.component';

const routes: Routes = [
  { path: '', pathMatch: 'full', redirectTo: 'landing' },
  { path: 'signup', component: SignupComponent },
  { path: 'login', component: LoginComponent },
  { path: 'landing', component: LandingComponent, canActivate: [AuthGuard] },
  { path: 'course', pathMatch: 'full', redirectTo: 'courses' },
  { path: 'course/:id', component: CourseDetailComponent, canActivate: [AuthGuard] , children: [
      { path: '', component: CourseOverviewComponent },
      { path: 'manage', component: ManageCourseComponent },
      { path: 'track', component: TrackComponent }
    ]
  },
  { path: 'courses', component: CourseListComponent, canActivate: [AuthGuard] },
  { path: 'history', component: HistoryComponent, canActivate: [AuthGuard] },
  { path: 'profile', component: ProfileComponent, canActivate: [AuthGuard] },
  { path: 'play', component: PlayComponent, canActivate: [AuthGuard] },
  { path: 'admin', loadChildren: () => import('./admin/admin.module').then(m => m.AdminModule) }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
